<?php
// Block File
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>

<section class="block block-documentation">
    <div class="container">
        <div class="navigation">
            <ul>
                <?php foreach ($skouerr_block->get_data('hierarchy') as $nav) : ?>
                    <li>
                        <a href="#<?php echo  sanitize_title($nav['title']); ?>"><?php echo $nav['title']; ?></a>
                        <ul>
                            <?php foreach ($nav['children'] as $sub) : ?>
                                <li><a data-title="<?php echo $sub; ?>" href="#<?php echo sanitize_title($sub); ?>"><?php echo $sub; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>



        </div>
        <div class="content">
            <?php $skouerr_block->the_data('readme'); ?>
        </div>
    </div>
</section>