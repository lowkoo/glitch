// $(document).ready(()=>{

// $()
let close_button = document.getElementById('close_btn');
let img_link = document.getElementById('fullimage');
let div_wrapper = document.getElementById('full_image');
let header = document.getElementById('header');
let homepage_overall_wrapper = document.getElementById('homepage_overall_wrapper');

function fullscreen(ImgLink){
    img_link.src = ImgLink;
    header.setAttribute('style', 'display:none');
    div_wrapper.setAttribute('style', 'display:flex','align-items:center', 'justify-content:center');
    homepage_overall_wrapper.setAttribute('style', 'position:fixed');
    
    
}

function close_fullscreen(){
    div_wrapper.setAttribute('style', 'display:none');
    header.setAttribute('style', 'display:flex');
    homepage_overall_wrapper.setAttribute('style', 'position:relative');
}
// })