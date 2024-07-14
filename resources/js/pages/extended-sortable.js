import Sortable from 'sortablejs';

var example1 = document.getElementById('example1'),
    example2Left = document.getElementById('example2-left'),
    example2Right = document.getElementById('example2-right'),
    example3Left = document.getElementById('example3-left'),
    example3Right = document.getElementById('example3-right'),
    example4Left = document.getElementById('example4-left'),
    example4Right = document.getElementById('example4-right'),
    example5 = document.getElementById('example5'),
    example6 = document.getElementById('example6'),
    example7 = document.getElementById('example7'),
    gridDemo = document.getElementById('gridDemo'),
    multiDragDemo = document.getElementById('multiDragDemo'),
    swapDemo = document.getElementById('swapDemo');

// Example 1 - Simple list
new Sortable(example1, {
    animation: 150,
    ghostClass: 'blue-background-class'
});


// Example 2 - Shared lists
new Sortable(example2Left, {
    group: 'shared', // set both lists to same group
    animation: 150
});

new Sortable(example2Right, {
    group: 'shared',
    animation: 150
});

// Example 3 - Cloning
new Sortable(example3Left, {
    group: {
        name: 'shared',
        pull: 'clone' // To clone: set pull to 'clone'
    },
    animation: 150
});

new Sortable(example3Right, {
    group: {
        name: 'shared',
        pull: 'clone'
    },
    animation: 150
});


// Example 4 - No Sorting
new Sortable(example4Left, {
    group: {
        name: 'shared',
        pull: 'clone',
        put: false // Do not allow items to be put into this list
    },
    animation: 150,
    sort: false // To disable sorting: set sort to false
});

new Sortable(example4Right, {
    group: 'shared',
    animation: 150
});


// Example 5 - Handle
new Sortable(example5, {
    handle: '.handle', // handle class
    animation: 150
});

// Example 6 - Filter
new Sortable(example6, {
    filter: '.filtered',
    animation: 150
});

// Example 7 - Thresholds

// Grid demo
new Sortable(gridDemo, {
    animation: 150,
    ghostClass: 'blue-background-class'
});

// Nested demo
var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));

// Loop through each nested sortable element
for (var i = 0; i < nestedSortables.length; i++) {
    new Sortable(nestedSortables[i], {
        group: 'nested',
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65
    });
}

// MultiDrag demo
new Sortable(multiDragDemo, {
    multiDrag: true,
    selectedClass: 'selected',
    fallbackTolerance: 3, // So that we can select items on mobile
    animation: 150
});


// Swap demo
new Sortable(swapDemo, {
    swap: true,
    swapClass: 'highlight',
    animation: 150
});