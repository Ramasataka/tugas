const toggle = document.getElementById('toggleDark');
const body = document.querySelector('body');
const head = document.getElementById('head');


toggle.addEventListener('click', function(){
    this.classList.toggle('fa-moon');
    if(this.classList.toggle('fa-sun')){
        head.classList.remove('bg-secondary');
        head.classList.add('bg-info');
        body.style.background = 'white';
        body.style.color = 'black';
        body.style.transform = '2s';
    }else{
        head.classList.remove('bg-info');
        head.classList.add('bg-secondary');
        body.style.background = 'black';
        body.style.color = 'white';
        body.style.transition = '2s';
    }
})