<template>
    <div class="bg-white shadow-lg rounded-lg text-sm">
      <div class="flex divide-x divide-green-default">
        <div
          :class="styleClasses"
          :style="{width: columnVisibility.index.width}"
        >
          #
        </div>
        <div
          v-if="columnVisibility.name.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.name.width}"
        >
          නම
        </div>
        <div
          v-if="columnVisibility.amountDetails.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.amountDetails.width}"
        >
          Amount Details
        </div>
        <div
          v-if="columnVisibility.edit.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.edit.width}"
        >
          edit
        </div>
      </div>
      <div
        class="divide-y divide-gray-200 bg-white rounded-b-lg"
      >
        
        <div
          v-if="!incomeSources.length"
          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
        >
          No records.
        </div>
  
        <div
          v-else
          class="divide-y divide-green-default"
        >
          <IncomeSourcesTableRow
            v-for="(incomeSource, index) in incomeSources"
            :key="incomeSource.id"
            :incomeSource="incomeSource"
            :index="index + 1"
            :column-visibility="columnVisibility"
            @select="$emit('select', $event)"
          />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  import IncomeSourcesTableRow from "@/Components/IncomeSources/IncomeSourcesTableRow.vue"
  import Spinner from "vue-spinner/src/ClipLoader.vue"
  
  export default {
      name: 'IncomeSourcesTable',
  
      components: {Spinner, IncomeSourcesTableRow},
  
      props: {
        incomeSources: {
              type: Array,
              required: true,
          },
      },
  
      computed: {
          styleClasses() {
              return 'text-green-default border-b border-green-default font-semibold p-3 text-sm flex items-center justify-center text-center'
          },
  
          columnVisibility() {
              return {
                  index: {visible: true, width: '3%'},
                  name: {visible: true, width: '20%'},
                  edit: {visible: true, width: '7%'},
                  amountDetails: {visible: true, width: '70%'},
                }
          },
  
      },
  
      methods: {

      }
  
  }
  </script>
  