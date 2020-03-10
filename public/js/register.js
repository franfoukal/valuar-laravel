window.onload = () => {
    
    let form = document.querySelector('form');
    let arrayForm = Array.from(form.elements);
    let token = arrayForm[0].value;

    //Picamos el array en juliana y le sacamos el submit, phone y recordar

    arrayForm.splice(0,1);
    arrayForm.splice(5,3);
    
    //Separamos los cachitos del array
    arrayForm.forEach((element) => {

        //eventlisteners correspondientes
        element.addEventListener('blur', () => {
            if (element.value == ''){
                element.classList.add('form-error');
                
            }
        });
        element.addEventListener('focus', () => {
            if (element.classList.contains('form-error')){
                element.classList.remove('form-error');
            }
        })
        
    })

    let email = form.querySelector('[name=email]');

    // cuando se hace pierde el foco en el campo email,
    // se hace un fetch a la db a ver si existe el input ingresado
    // en caso de q si devuelve true

    email.addEventListener('blur', () => {
        fetch('/email-check/' + email.value,
        {
            headers: {
                'X-CSRF-TOKEN' : token
            },
            method: 'GET' 
        })
        .then(response => {
            
            return response.json();
        })
        .then(data => {
            
            if (data[0] == true){
                
                email.classList.add('form-error');
            } else {
                if (email.classList.contains('form-error')){
                    email.classList.remove('form-error');
                }
            }
            
            })
        .catch(e => {
            return 'Error: ' + e;
        });
    });
    

    form.addEventListener('submit', (e) => {
        for (let field of arrayForm){
            if (field.classList.contains('form-error') || field.value == ''){
                e.preventDefault();
                if (field.value == ''){
                    field.classList.add('form-error');
                }
                document.querySelector('.form-errors').style.display = 'block';
            }

        }
    })
    
   
    

}