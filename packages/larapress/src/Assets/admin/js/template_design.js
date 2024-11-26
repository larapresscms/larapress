
//tempage design-----------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const leftList = document.getElementById('lp-left-list');
    const rightList = document.getElementById('lp-right-list');
    const orderInput = document.getElementById('lp-orderInput');

    // Initialize SortableJS for both containers
    const sortableLeft = new Sortable(leftList, {

        group: {
            name: 'shared',
            pull: 'clone',  // Enables copying
            put: false      // Disable items being put back in the left list
        },
        animation: 150,
        sort: false,  
        
        
        // group: 'shared',
         animation: 150,
         ghostClass: 'ghost',
         onEnd: updateOrder,
         
    });

    const sortableRight = new Sortable(rightList, {
        group: 'shared',
        animation: 150,
        ghostClass: 'ghost',

        onAdd: function (evt) {
            // Add close button to new items
            const item = evt.item;
            addCloseButton(item);
            updateOrder();
        },

        onEnd: updateOrder
    });

    // Update the hidden input with the current order
    function updateOrder() {
        const order = [...rightList.querySelectorAll('.lp-item')].map(item => item.getAttribute('data-id'));
        orderInput.value = order.join(',');
    }

    // Add a close button to the item
    function addCloseButton(item) {
        const closeButton = document.createElement('button');
        closeButton.className = 'close-btn';
        closeButton.innerHTML = '&times;';
        closeButton.addEventListener('click', function() {
            item.remove();
            updateOrder();
        });
        item.appendChild(closeButton);
    }

    // Add close buttons to any existing items in the right list (if any)
    document.querySelectorAll('#lp-right-list .lp-item').forEach(addCloseButton);

    // Trigger updateOrder on form submission
    //document.getElementById('orderForm').addEventListener('submit', updateOrder);

    //for footer----------------------------------------------------------------
    const rightListfooter = document.getElementById('lp-right-list-footer');
    const orderInputfooter = document.getElementById('lp-orderInput-footer');

    // if (rightListFooter) {

        const sortableRightfooter = new Sortable(rightListfooter, {
            group: 'shared',
            animation: 150,
            ghostClass: 'ghost',

            onAdd: function (evt) {
                // Add close button to new items
                const item = evt.item;
                addCloseButtonfooter(item);
                updateOrderfooter();
            },

            onEnd: updateOrderfooter
        });
    // }

    // Update the hidden input with the current order
    function updateOrderfooter() {
        const order2 = [...rightListfooter.querySelectorAll('.lp-item')].map(item => item.getAttribute('data-id'));
        orderInputfooter.value = order2.join(',');
    }

    // Add a close button to the item
    function addCloseButtonfooter(item) {
        const closeButton = document.createElement('button');
        closeButton.className = 'close-btn';
        closeButton.innerHTML = '&times;';
        closeButton.addEventListener('click', function() {
            item.remove();
            updateOrderfooter();
        });
        item.appendChild(closeButton);
    }

    // Add close buttons to any existing items in the right list (if any)
    document.querySelectorAll('#lp-right-list-footer .lp-item').forEach(addCloseButtonfooter);
});