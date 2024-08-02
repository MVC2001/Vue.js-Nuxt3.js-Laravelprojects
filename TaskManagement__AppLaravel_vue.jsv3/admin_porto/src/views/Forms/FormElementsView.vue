<script setup lang="ts">
import BreadcrumbDefault from '@/components/Breadcrumbs/BreadcrumbDefault.vue'
import CheckboxFive from '@/components/Forms/Checkboxes/CheckboxFive.vue'
import CheckboxFour from '@/components/Forms/Checkboxes/CheckboxFour.vue'
import CheckboxOne from '@/components/Forms/Checkboxes/CheckboxOne.vue'
import CheckboxThree from '@/components/Forms/Checkboxes/CheckboxThree.vue'
import CheckboxTwo from '@/components/Forms/Checkboxes/CheckboxTwo.vue'
import DatePickerOne from '@/components/Forms/DatePicker/DatePickerOne.vue'
import DatePickerTwo from '@/components/Forms/DatePicker/DatePickerTwo.vue'
import DefaultCard from '@/components/Forms/DefaultCard.vue'
import SwitchFour from '@/components/Forms/Switchers/SwitchFour.vue'
import SwitchOne from '@/components/Forms/Switchers/SwitchOne.vue'
import SwitchThree from '@/components/Forms/Switchers/SwitchThree.vue'
import SwitchTwo from '@/components/Forms/Switchers/SwitchTwo.vue'
import DefaultLayout from '@/layouts/DefaultLayout.vue'

import { ref } from 'vue'
import MultiSelect from '@/components/Forms/MultiSelect.vue'
import SelectGroupOne from '@/components/Forms/SelectGroup/SelectGroupOne.vue'

const pageTitle = ref('Form Elements')
</script>


<template>
  <DefaultLayout>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle" />
    <!-- Breadcrumb End -->

    <!-- ====== Form Elements Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1"> <!-- Changed grid-cols-2 to grid-cols-1 for small screens -->
      <div class="flex flex-col gap-9">
        <!-- Input Fields Start -->
        <DefaultCard cardTitle="Input Fields">
          <form action="" method="">
          <div class="flex flex-col gap-5.5 p-6.5">
            <div>
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Default Input
              </label>
              <input
                type="text"
                placeholder="Default Input"
                class="w-full rounded-lg border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
              />
            </div>

            <div>
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Active Input
              </label>
              <input
                type="text"
                placeholder="Active Input"
                class="w-full rounded-lg border-[1.5px] text-black border-primary bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:bg-form-input"
              />
            </div>
        
           
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-9 p-6.5"> <!-- Added grid classes to display in columns on small and medium screens -->
            <div>
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Default Input
              </label>
              <input
                type="text"
                placeholder="Default Input"
                class="w-full rounded-lg border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
              />
            </div>

            <div class="col-span-2 md:col-span-1"> <!-- Adjusted grid column classes to display in 2 columns on small screens and 1 column on medium screens -->
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Active Input
              </label>
              <input
                type="text"
                placeholder="Active Input"
                class="w-full rounded-lg border-[1.5px] text-black border-primary bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:bg-form-input"
              />
            </div>

            <div class="flex justify-center mt-4"> <!-- Added flex and justify-center classes to center the button -->
              <button class="py-2 px-6 bg-pale-dark w-50 text-white rounded-lg hover:bg-dark" style="background-color:black;">Add</button> <!-- Added button with pale-dark background -->
            </div>
          </div>

          
        </form>
        </DefaultCard>
        <!-- Input Fields End -->

        <!-- Add other form elements here -->

      </div>

    </div>
    <!-- ====== Form Elements Section End -->
  </DefaultLayout>
</template>
                   