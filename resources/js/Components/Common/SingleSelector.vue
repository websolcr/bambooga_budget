<template>
    <div
      style="min-width: 90px; width: auto"
    >
      <Listbox
        v-slot="{ open }"
        :model-value="modelValue"
      >
        <div class="relative mt-1">
          <label
            class="block text-xs font-medium text-gray-700"
          >
            {{ title }}
          </label>
          <ListboxButton
            :disabled="disabled"
            class="relative w-full rounded-md pl-3 pr-10 text-left shadow-md sm:text-xs"
            :class="[disabled ? 'cursor-not-allowed bg-gray-50' : 'cursor-pointer bg-white']"
            style="min-height: 30px"
          >
            <span
              v-if="modelValue"
              class="block truncate text-xs"
              v-html="modelValue[label]"
            />
            <span
              v-else
              class="text-gray-500"
            >{{ placeholder }} </span>
            <span
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
            >
              <chevron-up-icon
                v-if="open"
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
              />
              <chevron-down-icon
                v-else
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
              />
            </span>
          </ListboxButton>
  
          <transition
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
          >
            <div v-show="open">
              <ListboxOptions
                class="absolute mt-1 z-10 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-xs shadow-lg sm:text-xs"
              >
                <ListboxOption
                  v-for="option in options"
                  v-slot="{ active }"
                  :key="option.label"
                  :value="option[trackBy]"
                  as="template"
                  @click="$emit('update:modelValue', {...option})"
                >
                  <li
                    :class="[
                      active || option[trackBy] === modelValue?.[trackBy] ? 'bg-green-200 text-green-900' : 'text-gray-900',
                      'cursor-pointer py-2 px-2 block truncate text-xs text-left',
                    ]"
                    v-html="option[label]"
                  />
                </ListboxOption>
              </ListboxOptions>
            </div>
          </transition>
        </div>
      </Listbox>
    </div>
  </template>
  
  <script>
  import {
      Listbox,
      ListboxButton,
      ListboxOptions,
      ListboxOption,
  } from '@headlessui/vue'
  import ChevronUpIcon from "@/Icons/ChevronUpIcon.vue"
  import ChevronDownIcon from "@/Icons/ChevronDownIcon.vue"
  
  export default {
      name: 'SingleSelectorDropdown',
  
      components: {
          Listbox,
          ListboxButton,
          ListboxOptions,
          ListboxOption,
          ChevronUpIcon,
          ChevronDownIcon,
      },
  
      props: {
          options: {
              type: Array,
              default: () => [],
          },
          modelValue:{
              type: Object,
              default: () => null,
          } ,
          placeholder: {
              type: String,
              default: () => null,
          },
          label: {
              type: String,
              required: true,
          },
          trackBy: {
              type: String,
              default: () => 'id',
          },
          disabled: {
              type: Boolean,
              default: () => false,
          },
          title: {
              type: String,
              default: () => null,
          }
      },
  }
  </script>
  