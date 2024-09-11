/*
* Register block in WP Admin
*/
document.addEventListener('DOMContentLoaded', () => {
    wp.domReady( function() {
        const { registerBlockType } = wp.blocks;
        const { createElement } = wp.element;
        const { serverSideRender } = wp;
        const BLOCK_NAME = 'skouerr-theme/header-default';
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
});
