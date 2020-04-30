    let singleProduct = document.querySelectorAll('.product');
    let categories = document.querySelectorAll('.category');
    let services = document.querySelectorAll('.service');
    
    let options = {
        threshold: 0.2,
        margin: '200px 0 0 0'
    }
    let appearItem = (item) => {
        item.classList.remove('disappear');
    } 
    let appearAll = (item) => {
        if (item.contains('product')){
            singleProduct.forEach((product) => {
                appearItem(product);
            })
        } else if (item.contains('category')){
            categories.forEach(category => {
                appearItem(category);
            })
        } else if (item.contains('service')){
            services.forEach(service => {
                appearItem(service);
            })
        }
    }
    let observer = new IntersectionObserver(entry => {
        if (entry[0].isIntersecting) {
            if (window.outerWidth < 768){
                appearItem(entry[0].target);    
                observer.unobserve(entry[0].target);
            } else {
                appearAll(entry[0].target.classList);
            }
        }
    }, options);

    singleProduct.forEach(product => {
        observer.observe(product);
    })
    categories.forEach(category => {
        observer.observe(category);
    })
    services.forEach(service => {
        observer.observe(service);
    });
