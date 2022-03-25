let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;

//employee component
let storeemployee  = require('./components/employee/create.vue').default;
let employee  = require('./components/employee/index.vue').default;
let editemployee   = require('./components/employee/edit.vue').default;


//supplier component
let storesupplier  = require('./components/supplier/create.vue').default;
let supplier  = require('./components/supplier/index.vue').default;
let editsupplier   = require('./components/supplier/edit.vue').default;

//supplier component
let storecategory  = require('./components/category/create.vue').default;
let category  = require('./components/category/index.vue').default;
let editcategory   = require('./components/category/edit.vue').default;


//product component
let storeproduct  = require('./components/product/create.vue').default;
let product  = require('./components/product/index.vue').default;
let editproduct   = require('./components/product/edit.vue').default;


//expense component
let storeexpense  = require('./components/expense/create.vue').default;
let expense  = require('./components/expense/index.vue').default;
let editexpense   = require('./components/expense/edit.vue').default;


//customer component
let storecustomer  = require('./components/customer/create.vue').default;
let customer  = require('./components/customer/index.vue').default;
let editcustomer   = require('./components/customer/edit.vue').default;


//salery component
let allemployee  = require('./components/salery/all_employee.vue').default;
let create_salery = require('./components/salery/create.vue').default;
let allsalery  = require('./components/salery/index.vue').default;
let viewsalary  = require('./components/salery/view_salery.vue').default;
let editsalary  = require('./components/salery/edit.vue').default;


//stock component
let stock  = require('./components/product/stock.vue').default;
let editstock  = require('./components/product/edit-stock.vue').default;

//pos
let pos  = require('./components/pos/pos.vue').default;

// Order Component
let order = require('./components/order/order.vue').default;
let vieworder = require('./components/order/vieworder.vue').default;


export const routes = [
    { path: '/', component: login, name:'/'},
    { path: '/register', component: register, name:'register'},
    { path: '/forget', component: forget, name:'forget'},
    { path: '/home', component: home, name:'home'},
    { path: '/logout', component: logout, name:'logout'}, 

    //employee routes
    { path: '/store-employee', component: storeemployee, name:'store-employee'},
    { path: '/employee', component: employee, name:'employee'},
    { path: '/edit-employee/:id', component: editemployee, name:'edit-employee'},

    //supplier routes
    { path: '/store-supplier', component: storesupplier, name:'store-supplier'},
    { path: '/supplier', component: supplier, name:'supplier'},
    { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier'},


     //category routes
     { path: '/store-category', component: storecategory, name:'store-category'}, 
     { path: '/category', component: category, name:'category'},
     { path: '/edit-category/:id', component: editcategory, name:'edit-category'},

     //product routes
     { path: '/store-product', component: storeproduct, name:'store-product'},
     { path: '/product', component: product, name:'product'},
     { path: '/edit-product/:id', component: editproduct, name:'edit-product'},

     //expense routes
     { path: '/store-expense', component: storeexpense, name:'store-expense'},
     { path: '/expense', component: expense, name:'expense'},
     { path: '/edit-expense/:id', component: editexpense, name:'edit-expense'},


     //salery routes
     { path: '/all-employee', component: allemployee, name:'allemployee'},
     { path: '/create-salery', component: create_salery, name:'create-salery'},
     { path: '/salery', component: allsalery, name:'salery'},
     { path: '/view-salary/:id', component: viewsalary, name:'view-salary'},
     { path: '/edit-salary/:id', component: editsalary, name:'edit-salary'},

     //stock routes
     { path: '/stock', component: stock, name:'stock'},
     { path: '/edit-stock/:id', component: editstock, name:'edit-stock'},

     //customer routes
     { path: '/store-customer', component: storecustomer, name:'store-customer'},
     { path: '/customer', component: customer, name:'customer'},
     { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer'},

     //pos
     { path: '/pos', component: pos, name:'pos'},

      // Order Routes
     { path: '/order', component: order, name:'order'},
     { path: '/view-order/:id', component: vieworder, name:'view-order'},
    
  
  ]
