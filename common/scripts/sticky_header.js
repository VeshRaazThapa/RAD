window.onscroll = function() {stickyHeader()};
let element = document.getElementById('header');
// g = document.createElement('div');
// g.setAttribute("id", "entry_button");
function stickyHeader() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        element.classList.add('sticky_header_shadow')
    } else {
        element.classList.remove('sticky_header_shadow')
    }
}