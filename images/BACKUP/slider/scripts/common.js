function initSlider() {
    $('.bannerSlider').slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 5000,
        autoplay: true
    });
}

function getBannersCarrosel(){
    firebase.database().ref('bannerCarrosel').on('value', function(snapshot){
        let objCarrosel = [];
        snapshot.forEach(function(item){
            let data = item.val().obj,
                title = data.title,
                image = data.image,
                linkBanner = data.linkBanner,
                bannerType = data.bannerType,
                position = data.position;

            let bannerCarrosel = {
                'title': title,
                'image': image,
                'linkBanner': linkBanner,
                'bannerType': bannerType,
                'position': position
            }
            objCarrosel.push(bannerCarrosel);
        });
        insertBannerCarrosel(objCarrosel);
    });
}

function insertBannerCarrosel(obj){
    let count = 1,
        htmlSliderDesktop = '',
        htmlSliderMobile = '';
    for (let i = 0; i < obj.length; i++) {
        let number = count++;

        for (let v = 0; v < obj.length; v++) {
            let item = obj[v],
                title = item.title,
                image = item.image,
                linkBanner = item.linkBanner,
                linkHtmlInit = '',
                linkHtmlEnd = '',
                bannerType = item.bannerType,
                position = parseInt(item.position);

            if(linkBanner != '' && linkBanner != undefined && linkBanner!= null){
                linkHtmlInit = `<a href="${linkBanner}" target="_blank" class="linkBanner">`;
                linkHtmlEnd = `</a>`;
            }

            if(bannerType === 'desktop'){
                if(position === number){
                    htmlSliderDesktop += `<div>${linkHtmlInit}<img src="${image}" title="${title}" />${linkHtmlEnd}</div>`;
                }
            }
            if(bannerType === 'mobile'){
                if(position === number){
                    htmlSliderMobile += `<div>${linkHtmlInit}<img src="${image}" title="${title}" />${linkHtmlEnd}</div>`;
                }
            }
        }
    }
    $('.bannerSlider').html(htmlSliderDesktop);
    $('.bannerSlider.mobile').html(htmlSliderMobile);
    initSlider();

}

function init(){
    getBannersCarrosel();
    var parentWindow = window.parent.location;
            console.log(parentWindow);
}

$(document).on('ready', function() {      
    init();
});