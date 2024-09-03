/*
* Register block in WP Admin
*/
wp.domReady( function() {
    const { registerBlockType } = wp.blocks;
    const { createElement } = wp.element;
    const { serverSideRender } = wp;
    const BLOCK_NAME = 'skouerr/design-system';
    registerBlockType(BLOCK_NAME,{
        edit: function(){
            return createElement(
                serverSideRender,
                {
                    block: BLOCK_NAME
                }
            )
        },
        save: function(){
            return null;
        }
    }
    );
} );
