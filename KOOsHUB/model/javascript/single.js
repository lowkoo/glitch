$(document).ready(()=>{

    $('#submit_btn').on('click', ()=>{
        console.log('submit_btn clicked')
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../view/index.php", true);
        console.log('xhr_opened');
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data === "success"){
                        location.href = ".?action=login";
                        console.log('success');
                    }else{
                        $('.message_area').setAttribute('style', 'display:block;', 'color:white;');
                        $('.message_area').textContent = data;
                        console.log('an error occured');
                    }
                }
            }
        }
    })

    // $('input').on('over', ()=>{
    //     $('#open-eye').on('click', ()=>{
    //         if()
    //     })
    // })
    
})