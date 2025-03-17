<template>
    <div
      :class="isShowing ? 'show' : ''"
      class="slide-in overflow-y-scroll p-2 space-y-2 flex flex-col"
    >
      <div v-if="incomeSource">
        <div
          class="py-4 px-2 flex justify-between items-center"
        >
          <div class="font-semibold text-xs italic">
            {{ incomeSource.id ? 'ආදායම් මාර්ගයක් වෙනස් කරන්න' : 'නව ආදායම් මාර්ගයක් ඇතුළත් ක‍රන්න' }}
          </div>
          <CloseIcon
            class="w-6 h-6 float-right cursor-pointer text-green-default"
            @click="$emit('close')"
          />
        </div>

        <div
          class="space-y-2"
          style="min-height: calc(100vh - 250px)"
        >
          <div class="flex flex-col space-y-2 px-2">
              <div class="space-y-2 text-sm  divide-y divide-green-default">

                <div>
                  <label for="name">නම</label>
                  <base-input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="w-full"
                  />
                </div>
                <div>
                  <label for="payment_cycle">අය කරන ආකාරය</label>
                    <SingleSelector
                      v-model="selectedPaymentCycle"
                      label="label"
                      :options="paymentCycles"
                      track-by="id"
                    />
                </div>

                <div>
                  <div class="flex justify-between items-center py-2">
                    <div class="font-semibold">
                      ගාස්තු විස්තර
                    </div>
                    <div>
                      <AppButton
                        class="w-full h-8 font-semibold"
                        label="ඇතුළත් කරන්න"
                        @click="addAmountDetails"/>
                    </div>
                  </div>
                  <div
                    v-if="! form.amount_details.length"
                    class="text-sm mt-4 text-center"
                  >
                      ගාස්තු විස්තර නොමැත
                  </div>

                  <div
                    v-else
                    class="space-y-4"
                  >
                    <div
                      v-for="amountDetail in form.amount_details"
                      :key="amountDetail.id"
                      class="text-sm border-2 p-4"
                    >
                      <div>
                        <label for="amount">ගාස්තුව</label>
                        <base-input
                          id="amount"
                          :model-value="amountDetail.amount"
                          type="number"
                          class="w-full"
                          @update:model-value="modifyAmountDetail({...amountDetail, amount: $event})"
                        />
                      </div>
                      <div>
                        <label for="valid_from">වලංගු වන්නේ කවදා සිට ද?</label>
                        <base-input
                          id="valid_from"
                          :model-value="amountDetail.valid_from"
                          type="date"
                          class="w-full"
                          @update:model-value="modifyAmountDetail({...amountDetail, valid_from: $event})"
                        />
                      </div>
                      <div>
                        <label for="valid_from">අවලංගු වන්නේ කවදා සිට ද?</label>
                        <base-input
                          id="valid_from"
                          :model-value="amountDetail.valid_end"
                          type="date"
                          class="w-full"
                          @update:model-value="modifyAmountDetail({...amountDetail, valid_end: $event})"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="pt-4 space-y-2">
          <app-button
            class="w-full h-10 font-semibold"
            label="save"
            @click="emitSave"
          />
        </div>
      </div>
    </div>
  </template>

  <script>
  import CloseIcon from '@/Icons/CloseIcon.vue'
  import AppButton from "@/Components/AppButton.vue"
  import BaseInput from '@/Components/Common/BaseInput.vue'
  import {uniqueId} from "lodash";
  import SingleSelector from '../Common/SingleSelector.vue';

  const INITIAL_FORM = {
    id: '',
    name: '',
    payment_cycle: '',
    amount_details: [],
  }

  const PAYMENT_CYCLES = [
    'MONTHLY',
    'ONE_TIME',
  ]

  const PAYMENT_CYCLE_TO_LABEL_MAP = {
    MONTHLY: 'මාසිකව',
    ONE_TIME: 'එක් වරක්',
  }


  export default {
      name: 'IncomeSourceEditWidget',

      components: {
          SingleSelector,
          BaseInput,
          AppButton,
          CloseIcon
      },

      props: {
          isShowing: {
              type: Boolean,
              default: () => false,
          },

          incomeSource: {
              type: Object,
              default: () => null,
          },

      },

      data() {
          return {
              form: {...INITIAL_FORM},
          }
      },

      computed: {
          modifiedAmountDetails() {
            return this.form.amount_details.filter(amountDetail => {
              return amountDetail.is_new
                || amountDetail.amount !== this.getOriginalAmountDetail(amountDetail)?.amount
                || amountDetail.valid_from !== this.getOriginalAmountDetail(amountDetail)?.valid_from
                || amountDetail.valid_end !== this.getOriginalAmountDetail(amountDetail)?.valid_end
            }).map(amountDetail => {
              return {
                ...amountDetail,
                id: amountDetail.is_new ? null : amountDetail.id,
              }
            })
          },

          paymentCycles() {
            return PAYMENT_CYCLES.map(paymentCycle => {
                return {
                    id: paymentCycle,
                    label: PAYMENT_CYCLE_TO_LABEL_MAP[paymentCycle]
                }
            })
          },

          selectedPaymentCycle: {
            get() {
                return this.paymentCycles.find(paymentCycle => this.form.payment_cycle === paymentCycle.id)
            },
            set(paymentCycle) {
                this.form.payment_cycle = paymentCycle.id
            }
        },

      },

      watch: {
          incomeSource: {
              deep: true,
              handler() {
                if (this.incomeSource.is_new === true) {
                  this.form = {...INITIAL_FORM}
                  return
                }

                this.form = {
                  ...this.incomeSource,
                  amount_details: [...this.incomeSource.amount_details]
                }
              }
          },
      },

      methods: {
        modifyAmountDetail(modifiedAmountDetail) {
          this.form.amount_details = this.form.amount_details.map(existingAmountDetail => {
            if (modifiedAmountDetail.id !== existingAmountDetail.id){
              return existingAmountDetail
            }

            return {...modifiedAmountDetail}
          })
        },

        getOriginalAmountDetail(modifiedAmountDetail) {
            return this.incomeSource.amount_details.find(originalAmountDetail => originalAmountDetail.id === modifiedAmountDetail.id)
        },

        addAmountDetails() {
            const newAmountDetail = {
                id: uniqueId('amount_details-'),
                amount: null,
                valid_from: '',
                valid_end: '',
                is_new: true,
            }

            this.form.amount_details = [...this.form.amount_details, newAmountDetail]
        },

        emitSave() {
          this.$emit(
            'save',
            {
              ...this.form,
              amount_details: this.modifiedAmountDetails
            }
          )
        },
      },
  }
  </script>

  <style scoped>
  .slide-in {
      width: 350px;
      position: fixed;
      top: 64px;
      /*top: calc(64px - 10px);*/
      right: -100%;
      background: white;
      height: calc(100% - 64px);
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
      transition: all 0.8s ease-in-out;
  }

  .show {
      right: 0;
  }
  </style>
