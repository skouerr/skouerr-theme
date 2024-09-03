<section class="block block-design-system">
    <h1>Design System</h1>

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
                        Coucou
                    </code>
                </div>



            </div>
        <?php endforeach; ?>
    </div>

</section>