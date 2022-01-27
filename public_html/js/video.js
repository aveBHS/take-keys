$(document).ready(function () {
    $('.slider').slick({
        dots: true,
        adaptiveHeight: true,
        slidesToScroll: 1,
    });
    //$('.slider').slickPlay()
    //setTimeout($('.slider').slickPause(), 300)
});

function findVideos() {
    let videos = document.querySelectorAll('.slider__video');

    for (let i = 0; i < videos.length; i++) {
        setupVideo(videos[i]);
    }
}

function setupVideo(video) {
    let media = video.querySelector('.slider__img');
    let button = video.querySelector('.slider__btn');
    let id = parseMediaURL(media);
    let listener = () => {
        let iframe = createIframe(id);

        button.remove();
        media.remove();
        video.appendChild(iframe);

        video.removeEventListener('click', listener);
    };

    video.addEventListener('click', listener);

    video.classList.add('slider__video--enabled');
}

function parseMediaURL(media) {
    let regexp = /https:\/\/img\.youtube\.com\/vi\/([a-zA-Z0-9_-]+)\/0\.jpg/i;
    let url = media.src;
    let match = url.match(regexp);

    return match[1];
}

function createIframe(id) {
    let iframe = document.createElement('iframe');

    iframe.setAttribute('allowfullscreen', '');
    iframe.setAttribute('allow', 'autoplay');
    iframe.setAttribute('src', generateURL(id));
    iframe.classList.add('slider__iframe');

    return iframe;
}

function generateURL(id) {
    let query = '?rel=0&showinfo=0&autoplay=1&mute=1&enablejsapi=1';

    return 'https://www.youtube.com/embed/' + id + query;
}

findVideos();