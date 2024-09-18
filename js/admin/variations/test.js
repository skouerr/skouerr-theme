// Register a new block variation for the core/group block
document.addEventListener('DOMContentLoaded', function () {
  wp.domReady(function () {
    wp.blocks.registerBlockVariation('core/group', [{
        name:'test',
        title: 'Test',
        icon: 'block-default',
        attributes: {
          className: ''
        },
        innerBlocks: [
        ]
    }])
  })
});