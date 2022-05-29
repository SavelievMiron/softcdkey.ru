const archiveCampaign = document.querySelector('.archive-campaign');
if (archiveCampaign !== null) {
    const cards = archiveCampaign.querySelectorAll('.campaign-card');
    if (cards.length !== 0) {
        cards.forEach((el) => {
            const startDate = el.querySelector('.campaign-card__info--date').dataset.start,
            countDownDate = new Date(startDate*1000).getTime(),
            deadline = el.querySelector('.campaign-card__deadline');

            const refresh = setInterval(() => {
                let now = new Date().getTime();
                let distance = now - countDownDate;

                let days = Math.floor(distance / (1000 * 60 * 60 * 24)),
                hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                seconds = Math.floor((distance % (1000 * 60)) / 1000);

                deadline.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

                if (distance < 0) {
                    clearInterval(refresh);
                    deadline.innerHTML = "expired";
                }
            }, 1000);
        });
    }
    const loadMore = document.getElementById('loadmore');
    if (loadMore !== null) {
        loadMore.onclick = (e) => {
            
        }
    }
    
}