// Register a new block variation for the core/columns block
document.addEventListener('DOMContentLoaded', function () {
  wp.domReady(function () {
    wp.blocks.registerBlockVariation('core/columns', [{
        name:'four-columns',
        title: 'Four Columns',
        icon: 'grid-view',
        settings:{
            allowEditing: true,
        },
        attributes: {
          className: 'is-four-columns'
        },
        innerBlocks: [
          ['core/column'],
          ['core/column'],
          ['core/column'],
          ['core/column'],
        ]
    }])
  })
});