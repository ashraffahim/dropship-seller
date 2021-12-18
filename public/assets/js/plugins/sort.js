(function (global) {
  "use strict";

  var init = function(){
    sortable('.sortable', 
      {
        forcePlaceholderSize: true
      }
    );

    // with handle
    sortable('.sortable-handle',
      {
        forcePlaceholderSize: true,
        placeholderClass: 'list-item',
        handle: '.js-handle'
      }
    );

    // sortable table
    sortable('.sortable-table', {
      items: 'tr',
      placeholder: '<tr style="border: 2px dashed #eee"><td colspan="' + $('#menuContainer form table tbody tr td').length + '">&nbsp;</td></tr>',
    });
  }

  // for ajax to init again
  global.sort = {init: init};

})(this);
