const tabs = document.querySelectorAll('ul li');
const divs = document.querySelectorAll('.content > div');

tabs.forEach((tab) => {
    
    tab.addEventListener("click", function (e) {
        tabs.forEach((tab) => {
            
            tab.classList.remove("active");
        });
        
        e.currentTarget.classList.add("active");
        divs.forEach((div) => {
            
            div.style.display = 'none';
           
            document.querySelector('.' + e.currentTarget.dataset.content).style.display = 'flex';
        });
    });
})