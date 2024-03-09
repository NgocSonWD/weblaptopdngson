// -----------------------hinhAnhKhac-------------------------
var hak = document.querySelectorAll(".imgsp_hak");
var hinh = document.querySelectorAll(".mahinh");

for(let i = 0; i < hak.length; i++ ){

    hak[i].addEventListener("click", (event) => {
        
        var img = document.querySelector("#hak_img--js");

        img.src = "IMG/sanpham/"+ hinh[i].innerText;
    });
}

// -------------------------trangCaNhan--------------------
var user_info = document.querySelector("#taikhoan__list--acc"); 
console.log(user_info);
user_info.addEventListener("click", function info(){
    
    document.getElementById("#items").classList.toggle("hien");
    
})

// -----------------------bangCauHinh-------------------------
var modalOpen = document.querySelector(".modal_open");
var modal = document.querySelector(".modal");
var iconClose = document.querySelector(".modal__header p");
var btnClose = document.querySelector(".modal__footer button");

function toggleModal(e){
    modal.classList.toggle("hide");
}

modalOpen.addEventListener("click",toggleModal)
iconClose.addEventListener("click",toggleModal)
btnClose.addEventListener("click",toggleModal)
modal.addEventListener("click",function(e){
    if(e.target == e.currentTarget){
        toggleModal()
    }
})




