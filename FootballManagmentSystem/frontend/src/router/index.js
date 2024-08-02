import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginVue from '@/views/Auth/Login.vue'
import RegisterVue from '@/views/Auth/Register.vue'
import PlaygroundlistsVue from '@/views/PlayGrounds/Playgroundlists.vue'
import DashboardVue from '@/views/Dashboard/Dashboard.vue'
import OurShopVue from '@/views/PlayGrounds/OurShop.vue'
import AddNewGroundVue from '@/views/PlayGrounds/AddNewGround.vue'
import OurGroundsVue from '@/views/OurGrounds.vue'
import ShopAccountVue from '@/views/ShopAccount.vue'
import AddnewItemVue from '@/views/AddnewItem.vue'
import YourCartVue from '@/views/YourCart.vue'
import YourSuccessfullVue from '@/views/YourSuccessfull.vue'
import RequestPannelVue from '@/views/RequestPannel.vue'
import ContactUsVue from '@/views/ContactUs.vue'
import OrdersVue from '@/views/Orders/Orders.vue'
import EditCartVue from '@/views/Orders/EditCart.vue'
import ViewSalesVue from '@/views/sales/ViewSales.vue'
import EditSalesVue from '@/views/sales/EditSales.vue'
import AddToSalesVue from '@/views/sales/AddToSales.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/contactus',
    name: 'contactus',
    component: ContactUsVue
  },
  {
    path: '/login',
    name: 'login',
    component: LoginVue
  },
  {
    path: '/register',
    name: 'register',
    component:RegisterVue
  },
  {
    path: '/shopground',
    name: 'shopground',
    component: PlaygroundlistsVue
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardVue
  },
  {
    path: '/ourshop',
    name: 'ourshop',
    component: OurShopVue
  },
  {
    path: '/ourgrounds',
    name: 'ourgrounds',
    component:  OurGroundsVue
  },
  {
    path: '/successmessage',
    name: 'successmessage',
    component: YourSuccessfullVue
  },
  {
    path: '/playgroundaccount',
    name: 'playgroundaccount',
    component: PlaygroundlistsVue
  }, 
  {
    path: '/yourcart/:id/added-to-yourcart',
    name: 'yourcart',
    component: YourCartVue
  },
  {
    path: '/carts/:id/edit-orderById',
    name: 'carts',
    component: EditCartVue
  },
  {
    path: '/orders',
    name: 'orders',
    component: OrdersVue
  },
  {
    path: '/view-sales',
    name: 'view-sales',
    component: ViewSalesVue
  },
  {
    path: '/create-sales',
    name: 'create-sales',
    component: AddToSalesVue
  },
 

  {
    path: '/sales/:id/editSaleById',
    name: 'sales',
    component: EditSalesVue
  },
  {
    path: '/cart/:id/added-to-yourcartv1',
    name: 'cart',
    component: RequestPannelVue
  },

  {
    path: '/addNewItem',
    name: 'addNewItem',
    component: AddnewItemVue
  },
  {
    path: '/shopaccount',
    name: 'shopaccount',
    component: ShopAccountVue
  },
  {
    path: '/addnewdetail',
    name: 'addnewdetail',
    component: AddNewGroundVue
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
