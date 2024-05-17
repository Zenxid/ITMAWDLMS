let next = document.querySelector('.next')
let prev = document.querySelector('.prev')

next.addEventListener('click', function(){
    let lists = document.querySelectorAll('.item')
    document.querySelector('.slide').appendChild(lists[0])
})

prev.addEventListener('click', function(){
    let lists = document.querySelectorAll('.item')
    document.querySelector('.slide').prepend(lists[lists.length - 1])
})

