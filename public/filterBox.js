
document.addEventListener("DOMContentLoaded", function () {
    const filter=document.getElementsByClassName('filter')[0];
    const filterButton=document.getElementsByClassName('filterOption')[0];
    const filterSubmitButton=document.querySelector('.filterSubmit');
    const closeButton=document.querySelector('.closeFilter');

    filterButton.addEventListener('click',function(){
        filter.classList.toggle('filterHidden');
    })
    filterSubmitButton.addEventListener('click',function(){
        filter.classList.toggle('filterHidden');
    })
    closeButton.addEventListener('click',function(){
        filter.classList.toggle('filterHidden');
    })
});
