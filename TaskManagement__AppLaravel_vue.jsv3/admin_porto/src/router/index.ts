import { createRouter, createWebHistory } from 'vue-router'
import SigninView from '@/views/Authentication/SigninView.vue'
import SignupView from '@/views/Authentication/SignupView.vue'
import CalendarView from '@/views/CalendarView.vue'
import ECommerceView from '@/views/Dashboard/DashboardView.vue'
import FormElementsView from '@/views/Forms/FormElementsView.vue'
import FormLayoutView from '@/views/Forms/FormLayoutView.vue'
import SettingsView from '@/views/Pages/SettingsView.vue'
import ProfileView from '@/views/ProfileView.vue'
import TablesView from '@/views/TablesView.vue'
import AlertsView from '@/views/UiElements/AlertsView.vue'
import ButtonsView from '@/views/UiElements/ButtonsView.vue'
import DashboardView from '@/views/Dashboard/DashboardView.vue'
import CreateView from '@/views/Tasks/CreateView.vue'
import ResertPasswordView from '@/views/Authentication/ResertPasswordView.vue'
import EditTaskView from '@/views/Tasks/EditTaskView.vue'
import AllWorksView from '../views/Tasks/AllWorksView.vue'
import AddCategoryView from '@/views/TaskCategories/AddCategoryView.vue'
import CategoriesView from '@/views/TaskCategories/CategoriesView.vue'
import EditCategoryView from '@/views/TaskCategories/EditCategoryView.vue'

const routes = [
  {
    path: '/dashboard',
    name: 'adminDashboard',
    component:  DashboardView,
    meta: {
      title: 'admin Dashboard'
    }
  },
  
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta: {
      title: 'Profile'
    }
  },
  {
    path: '/forms/form-elements',
    name: 'formElements',
    component: FormElementsView,
    meta: {
      title: 'Form Elements'
    }
  },
  //task start here
  {
    path:'/create-task',
    name: 'create-sale',
    component: CreateView,
    meta: {
      title: 'Create Task'
    }
  },

  {
    path: '/tasks',
    name: 'tasks',
    component: AllWorksView,
    meta: {
      title: 'All Task'
    }
  },

  {
    path: '/edit-task/:id',
    name: 'EditTask',
    component: EditTaskView,
    props: true,
  },
  //ends

  //categoey start here
  {
    path:'/create-category',
    name: 'create-category',
    component: AddCategoryView,
    meta: {
      title: 'Create  Category ino'
    }
  },
  
  {
    path: '/categories',
    name: 'categories',
    component: CategoriesView,
    meta: {
      title: 'All categories info'
    }
  },
  {
    path: '/edit-category/:id',
    name: 'EditCategory',
    component: EditCategoryView,
    props: true,
  },
  //ends

  {
    path: '/tables',
    name: 'tables',
    component: TablesView,
    meta: {
      title: 'Tables'
    }
  },
  {
    path: '/pages/settings',
    name: 'settings',
    component: SettingsView,
    meta: {
      title: 'Settings'
    }
  },
 
  {
    path: '/ui-elements/alerts',
    name: 'alerts',
    component: AlertsView,
    meta: {
      title: 'Alerts'
    }
  },
  {
    path: '/ui-elements/buttons',
    name: 'buttons',
    component: ButtonsView,
    meta: {
      title: 'Buttons'
    }
  },
  {
    path: '/',
    name: 'signin',
    component: SigninView,
    meta: {
      title: 'Signin'
    }
  },
  {
    path: '/auth/signup',
    name: 'signup',
    component: SignupView,
    meta: {
      title: 'Signup'
    }
  },
  {
    path: '/auth/resert-password',
    name: 'resert-password',
    component: ResertPasswordView,
    meta: {
      title: 'resert-password'
    }
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  }
})

router.beforeEach((to, from, next) => {
  document.title = `Vue.js ${to.meta.title} | Petrol station management application`
  next()
})

export default router
