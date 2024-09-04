<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/xml.min.js"></script>


<section class="block block-design-system">
    <h1>Design System</h1>

    <h2>Logos</h2>

    <h2>Colors</h2>

    <div class="colors">
        <?php foreach ($skouerr_block->get_data('color_groups') as $group) : ?>
            <div class="group">
                <?php foreach (array_reverse($group) as $key => $color) : ?>
                    <div class="color-block" data-title="<?php echo $color['name']; ?>" data-step='<?php echo $color['slug']; ?>' data-variable="var(--wp--preset--color--<?php echo $color['slug']; ?>)" style="--bg-color : var(--wp--preset--color--<?php echo $color['slug']; ?>)">
                        <?php echo $color['name']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Atoms</h2>

    <div class="atoms">
        <?php foreach ($skouerr_block->get_data('atoms') as $atom) : ?>
            <div class="atom">
                <h3><?php echo $atom['name']; ?></h3>
                <h4>Description</h4>
                <p><?php echo $atom['description']; ?></p>
                <h4>Preview</h4>
                <div class="preview">
                    <?php echo do_blocks($atom['render']); ?>
                </div>
                <h4>Code</h4>
                <div class="code">

                    <code class="language-html" contenteditable="true">
                    </code>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Variables</h2>


</section>