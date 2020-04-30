@extends('profile')
@section('section')
<orders inline-template>

    <div class="container-fluid">
        <div class="container">
            <div class="card">
                
            </div>
        </div>
    </div>

</orders>

<script type="application/javascript">
    Vue.component('orders', {
        data() {
            return {
                msg: 'hola',
            }
        },
        methods: {
            async getOrders(){
                let me = this;

                await axios.get('/orders/get')
                .then(response => {
                    console.log(JSON.parse(response.data.orders));
                })
                .catch(error => {
                    console.log(error.response);
                    
                });
            }
        },
        created() {
            this.getOrders();
        },
    });
</script>
@endsection