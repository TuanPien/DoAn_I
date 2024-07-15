//slider
const imgNumber = document.querySelectorAll('.slider-content-left-top img')
let homepage = 0;
const rightbtn = document.querySelector('.fa-solid.fa-chevron-right');
const leftbtn = document.querySelector('.fa-solid.fa-chevron-left');

rightbtn.addEventListener("click", function() {
    homepage = homepage + 1;
    if(homepage > imgNumber.length - 1) {
        homepage = 0;
    }
    document.querySelector(".slider-content-left-top").style.right = homepage * 100 + "%";
});


leftbtn.addEventListener("click", function() {
    homepage = homepage - 1
    if( homepage <= -1 ) {
        homepage = imgNumber.length - 1
    }
    document.querySelector(".slider-content-left-top").style.right = homepage*100+"%";
});
//slider 1
const imgNumberLi = document.querySelectorAll('.slider-content-left-bottom li')
imgNumberLi.forEach(function(image, homepage){
    image.addEventListener("click",function(){
        removeactive ()
        document.querySelector(".slider-content-left-top").style.right = homepage*100+"%"
        image.classList.add("active")
    })
})
function removeactive(){
    let imgactive = document.querySelector('.active')
    imgactive.classList.remove("active")
}

//slide2
function imgAuto() {
    homepage= homepage + 1
    if(homepage > imgNumber.length - 1) {
        homepage = 0;
    }
    removeactive ()
    document.querySelector(".slider-content-left-top").style.right = homepage*100+"%"
    imgNumberLi[homepage].classList.add("active")
}
setInterval(imgAuto,5000)

//-------------slider-product//

const rightbtntwo = document.querySelector('.fa-solid.fa-chevron-right-two')
const leftbtntwo = document.querySelector('.fa-solid.fa-chevron-left-two')
const imgNumbertwo = document.querySelectorAll('.slider-product-one-content-items')

rightbtntwo.addEventListener("click", function() {
    homepage = homepage + 1;
    if(homepage > imgNumbertwo.length - 1) {
        homepage = 0;
    }
    document.querySelector(".slider-product-one-content-items-content").style.right = homepage * 100 + "%";
});


leftbtntwo.addEventListener("click", function() {
    homepage = homepage - 1
    if( homepage <= -1 ) {
        homepage = imgNumbertwo.length - 1
    }
    document.querySelector(".slider-product-one-content-items-content").style.right = homepage*100+"%";
});

//----------product-catergory---//

const itemsliderbar = document.querySelectorAll(".cartegory-left-li")
itemsliderbar.forEach(function(menu,index){
    menu.addEventListener("click", function(){
        menu.classList.toggle("block")
    })
})

//-----------product------------//
const bigImg = document.querySelector(".product-content-left-big-img img");
const smallImg = document.querySelectorAll(".product-content-left-small-img img");

if (bigImg) {
    smallImg.forEach(function(imgItem, index) {
        imgItem.addEventListener("click", function() {
            bigImg.src = imgItem.src;
        });
    });
}

const thongtin = document.querySelector(".product-content-right-bottom-content-title-item thongtin");
const script =  document.querySelector(".product-content-right-bottom-content-title-item script");

if (script) {
    script.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-thongtin").style.display = "none";
        document.querySelector(".product-content-right-bottom-content-script").style.display = "block";
    });
}

if (thongtin) {
    thongtin.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-thongtin").style.display = "block";
        document.querySelector(".product-content-right-bottom-content-script").style.display = "none";
    });
}

const butTon = document.querySelector(".product-content-right-bottom-top");
if (butTon) {
    butTon.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB");
    });
}

/*----------------------history-----------------------*/
function hideRow(button) {
    // Tìm đến phần tử cha của nút bấm, đó là thẻ <tr>
    var row = button.parentNode.parentNode;
    // Ẩn hàng bằng cách thêm lớp CSS
    row.classList.add('hidden');
}