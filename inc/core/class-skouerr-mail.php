<?php

use Twig\Loader\FilesystemLoader;

new Skouerr_Mail();
class Skouerr_Mail
{
    public function __construct()
    {
        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::add_command('skouerr-theme mail', array($this, 'cli'));
        }
        add_filter('wp_mail', array($this, 'skouerr_mail_template_html'));
    }

    public function cli($args, $assoc_args)
    {
        if (isset($assoc_args['test'])) {
            WP_CLI::line('Sending test email...');
            $this->send_test();
            WP_CLI::success('Test email sent');
        }

        if (isset($assoc_args['dump'])) {
            WP_CLI::line('Dumping theme variables...');
            $this->send_dump();
            WP_CLI::success('Theme variables dumped');
        }
    }

    public function send_test()
    {

        $to = get_option('admin_email');
        $subject = 'Testing email from Skouerr theme';
        $message = $this->render_content_mail('This is a test email from Skouerr theme', 'test');
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    }

    public function get_mail_html_test(){
        $content = $this->render_content_mail('This is a test email from Skouerr theme', 'test');
        echo $this->render_skouerr_mail_template('default', array('content' => $content,'title'=>'Test email'));
    }

    public function send_dump()
    {
        $to = get_option('admin_email');
        $subject = 'Dumping theme variables';
        $message = $this->render_content_mail('', 'dump-variables');
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    }

    public function skouerr_mail_template_html($args)
    {
        $template = apply_filters('skouerr_mail_template', 'default');
        $use_template = apply_filters('skouerr_mail_use_template', true);


        if ($use_template) {

            if (!str_contains($args['headers'][0], 'text/html')) {
                $message = trim($args['message'], "\r\n");
                $args['headers'] = 'Content-Type: text/html; charset=UTF-8';
                $data = array('content' => nl2br($message));
            } else {

                $message = $args['message'];
                $data = array('content' => $message);
            }

            $args['message'] = $this->render_skouerr_mail_template($template, $data);
        }
        return $args;
    }

    public function render_content_mail($content, $template)
    {
        $data = $this->get_theme_variables();
        $data['content'] = $content;
        return $this->render_twig(get_template_directory() . '/mails/', $template, $data);
    }

    public function render_skouerr_mail_template($template = 'default', $data = array())
    {
        $data = array_merge($data, $this->get_theme_variables());
        $html = $this->render_twig(get_template_directory() . '/mails/templates/', $template, $data);
        return $html;
    }

    public function render_twig($path, $template, $data)
    {
        $loader = new FilesystemLoader($path);
        $twig = new \Twig\Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $html = $twig->render($template . '.twig', $data);
        return $html;
    }

    public function get_theme_variables()
    {
        $tree = WP_Theme_JSON_Resolver::resolve_theme_file_uris(WP_Theme_JSON_Resolver::get_merged_data());
        $styles = $tree->get_stylesheet(array('variables'), array('default', 'theme', 'custom'));
        $variables = $this->parseCSSVariables($styles);

        $variables['site_url'] = get_site_url();
        $variables['site_name'] = get_bloginfo('name');
        $variables['site_description'] = get_bloginfo('description');
        $variables['site_email'] = get_option('admin_email');
        $variables['site_logo'] = get_site_logo_url();
        $variables['year'] = date('Y');


        // conver key - to _
        $variables['variables'] = array();
        foreach ($variables as $key => $value) {
            if (str_contains($key, '-')) {
                $variables[str_replace('-', '_', $key)] = $value;
                unset($variables[$key]);
            }

            $variables['variables'][] = array('key' => $key, 'value' => $value);
        }
        return $variables;
    }

    public function parseCSSVariables($css)
    {
        $variables = [];

        // Enlever le bloc ":root{}"
        $css = preg_replace('/^:root\s*{|}$/', '', $css);

        // Extraire les paires clé-valeur
        preg_match_all('/--([a-zA-Z0-9-]+):\s*([^;]+);/', $css, $matches, PREG_SET_ORDER);

        // Stocker les paires dans le tableau associatif
        foreach ($matches as $match) {
            $variables[$match[1]] = trim($match[2]);
        }

        return $variables;
    }
}
