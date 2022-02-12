<template>
  <div>
       <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>
         
          <div class="row mb-3">
           

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <a class="btn btn-sm btn-primary"><font color="#fffff">Add Customer</font></a>
                </div>



                
                <div class="table-responsive" style="font-size:14px">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{ cart.pro_name}}</td>
                        <td>
                          <input type="text" readonly="" :value="cart.pro_quantity" style="width:25px;">
      <button class="btn btn-sm btn-success" @click.prevent="increment(cart.id)">+</button>
      <button class="btn btn-sm btn-danger"  @click.prevent="decrement(cart.id)" v-if="cart.pro_quantity >= 2">-</button>
      <button class="btn btn-sm btn-danger" v-else disabled="">-</button>
                        </td>
                        <td>{{ cart.product_price}}</td>
                        <td>{{ cart.sub_total}}</td>
                        <td><a @click="removeCart(cart.id)" class="btn btn-sm btn-primary"><font color="#fffff">x</font></a></td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                 <div class="card-footer">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Quantity:<strong>{{  qty }}</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Sub Total:<strong>{{ subtotal }}$</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Vat:<strong>{{ vats.vat }} %</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total :<strong>{{ subtotal*vats.vat /100 + subtotal}}$</strong>
                      </li>
                    </ul>
                    <br><br>

                    <form @submit.prevent="orderdone">
                       <label for="">Customer Name</label>
                       <select class="form-control" v-model="customer_id">
  <option :value="customer.id" v-for="customer in customers" :key="customer">{{customer.name }} </option>
                        
                       </select>

                       <label for="">Pay</label>
                       <input type="text" class="form-control" required="" v-model="pay">
                        
                        <label for="">Due</label>
                       <input type="text" class="form-control" required="" v-model="due">

                        <label for="">Pay By</label>
                       <select  class="form-control" v-model="payby">
                         <option value="HandCash">Hand Cash</option>
                         <option value="Cheaque">Cheaque</option>
                           <option value="GiftCard">Gift Card</option>
                       </select>

                       <button type="submit" class="btn btn-success" style="margin-top:8px;">Submit</button>

                    </form>
                 </div>

        
              </div>
            </div>


            
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                 
                </div>

            <!-- category wise product-->
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                   <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                   </li>
                  <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">
                          {{ category.category_name }}
                        </a>
                  </li>
                  
                </ul>
               <div class="tab-content" id="myTabContent"> <!-- all cproduct-->
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-body">
                    <input type="text" v-model="searchTerm" class="form-control" placeholder="search product" style="width:567px;">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-6" v-for="product in filtersearch" :key="product.id">
                          <button class="btn btn-sm" @click="AddToCart(product.id)">
                            <div class="card" style="width: 8.5rem; margin-bottom:5px;">
                              <img  :src="product.image" id="emp_photo" class="card-img-top">
                              <div class="card-body">
                                 <h6 class="card-title">{{ product.product_name }}</h6>
                  <span v-if="product.product_quantity >= 1" class="badge badge-success">Available {{ product.product_quantity }}</span>
                  <span v-else class="badge badge-danger">Stock Out </span> 
                                
                              </div>
                            </div>
                          </button>
                       </div>

                    </div>
                    
                 
                  </div> 

                </div>  <!-- end all  product-->

                    <!--start subcategory product-->
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <input type="text" v-model="getsearchTerm" class="form-control" style="width: 588px; margin-bottom:5px;" placeholder="Search Product">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                           <button class="btn btn-sm" @click="AddToCart(getproduct.id)">
                            <div class="card" style="width: 8.5rem; margin-bottom:5px;">
                              <img  :src="getproduct.image" id="emp_photo" class="card-img-top">
                              <div class="card-body">
                                 <h6 class="card-title">{{ getproduct.product_name }}</h6>
                  <span v-if="getproduct.product_quantity >= 1" class="badge badge-success">Available {{ getproduct.product_quantity }}</span>
                  <span v-else class="badge badge-danger">Stock Out </span> 
                                
                              </div>
                            </div>
                          </button>
                       </div>

                    </div>
                      
                  </div>
                 
                </div>

            <!-- end subproduct category wise product-->
               
                
              </div>
            </div>
            <!-- Invoice Example -->
           
          </div>
          <!--Row-->

         

        </div>
    
  </div>
</template>

<script type="text/javascript">
export default{
  
  created(){
    if(!User.loggedIn()){
       this.$router.push({ name: '/'})
    }
  },
   created(){
    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.cartProduct();
    this.vat();

    Reload.$on('AfterAdd',() =>{
      this.cartProduct();
    })
  },
  data(){
    return{
      customer_id:'',
      pay:'',
      due:'',
      payby:'',

      products:[],
      categories:[],
      getproducts:[],
      searchTerm:'',
      getsearchTerm:'',
      customers:[],
      carts:[],
      vats:''
    }
  },
  computed:{
    filtersearch(){
      return this.products.filter(product =>{
        return product.product_name.match(this.searchTerm)
      })
    },
     getfiltersearch(){
      return this.getproducts.filter(getproduct => {
         return getproduct.product_name.match(this.getsearchTerm)
       }) 
    },
    qty(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity));      
        }
        return sum;
   },

  subtotal(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].product_price));   
        }
        return sum;
   }

  },
  methods:{

    AddToCart(id){
        //alert(id);
        axios.get('/api/addtocart/'+id)
        .then(() =>{
          Reload.$emit('AfterAdd');
          Notification.cart_success()
        })
        .catch()
    },

    cartProduct(){
      console.log('cart product')
      axios.get('/api/cart/product/')
      .then(({data}) => (this.carts = data))
      .catch()
    },

    removeCart(id){
        axios.get('/api/remove/cart/'+id)
        .then(() =>{
          Reload.$emit('AfterAdd');
          Notification.cart_delete()
        })
        .catch()
    },

    increment(id){
        axios.get('/api/increment/'+id)
        .then(() =>{
          Reload.$emit('AfterAdd');
          Notification.success()
        })
        .catch()
    },
     decrement(id){
        axios.get('/api/decrement/'+id)
        .then(() =>{
          Reload.$emit('AfterAdd');
          Notification.success()
        })
        .catch()
    },
    vat(){
       axios.get('/api/vats/')
      .then(({data}) => (this.vats = data))
      .catch()
  },
   orderdone(){
  
    let total = this.subtotal*this.vats.vat/100 + this.subtotal;
    var data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, payby:this.payby, pay:this.pay, due:this.due, vat:this.vats.vat, total:total }
    axios.post('/api/orderdone',data)
       .then(() => {
          Notification.success()
         this.$router.push({name: 'home'})
       }) 
  },

  allProduct(){
       axios.get('/api/product')
       .then(({data}) => (this.products = data))
       .catch()
    },
     allCategory(){
       axios.get('/api/category')
       .then(({data}) => (this.categories = data))
       .catch()
    },
    subproduct(id){
        axios.get('/api/getting/product/'+id)
        .then(({data}) => (this.getproducts = data))
        .catch()
    },
    allCustomer(){
       axios.get('/api/customer')
       .then(({data}) => (this.customers = data))
       .catch(console.log('error'))
    },

  }
 
 
}

</script>

<style text="text/css" scoped>
 #emp_photo{
    height: 80px;
    width: 134px;
  }
</style>
