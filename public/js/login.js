window.onload = () => {

    let form = document.querySelector('form');
    
    let arrayForm = Array.from(form.elements);

    let token = arrayForm[0].value;

    arrayForm.splice(0,1);
    arrayForm.splice(2,2);

    arrayForm.forEach((element) => {
        element.addEventListener('focus', () => {
            if (element.classList.contains('form-error')){
                element.classList.remove('form-error')
            }
        })
    })

    form.addEventListener('submit',(event) => {

        event.preventDefault();
        
        let data = new FormData(form);
        
        fetch('/login-check', {
            
            headers: {
                'X-CSRF-TOKEN': token
            },
            method: 'POST',
            body: data
        })
        .then(response => {
            if (response.redirected){
                window.location.href = '/';
            }
            return response.json();
        })
        .then(data => { 
            if (data == false){
                arrayForm.forEach((element) => {
                    element.classList.add('form-error');
                });
                document.querySelector('.form-errors').style.display = 'block';
            }
        })
        .catch(e => {
            return e;
        });
    })
    
}