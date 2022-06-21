<template>
    <div class="">
        <h4 class="text-right my-3 d-none">
            {{ calculateTotal }}
            <i class="fas fa-fire text-danger"></i>
        </h4>
    </div>
</template>

<script>
export default {
    props: {
        form: {
            default() {
                return null;
            }
        }
    },
    filters: {
        formatMoney: function(value) {
            return accounting.formatMoney(value, currencyConfig.currency);
        }
    },

    data() {
        return {
            pricingTypes: {
                fixed: 1,
                perWord: 2,
                perPage: 3,
                perSlide: 4
            },
            spacingTypes: {
                double: "double",
                single: "single"
            }
        };
    },

    computed: {
        calculateTotal: function() {
            if (!this.isObjectEmpty(this.form)) {
                var form = this.form;
                var serviceModel = form.service_model;
                var subCategory = form.sub_category;
                var pricingTypes = this.pricingTypes;
                var spacingTypes = this.spacingTypes;
                var workLevelModel = form.work_level_model;
                var urgencyModel = form.urgency_model;
                var guaranteeModel = form.guarantee_model;

                // When Price Type is fixed
                if (
                    serviceModel.price_type_id == pricingTypes.fixed ||
                    serviceModel.price_type_id == pricingTypes.perSlide
                ) {
                    var quantity = 1;
                    var base_price = parseFloat(serviceModel.price);
                    if (subCategory) {
                        base_price = parseFloat(subCategory.price);
                    }
                }
                // When Price Type is Per Word
                if (serviceModel.price_type_id == pricingTypes.perWord) {
                    var quantity = parseFloat(form.number_of_words);
                    var base_price = parseFloat(serviceModel.price);
                }
                // When Price Type is Per slide
                if (serviceModel.price_type_id == pricingTypes.perSlide) {
                    var quantity = parseFloat(form.number_of_slides);
                    var base_price = parseFloat(serviceModel.price);
                }
                // When Price Type is based on Number of Pages
                if (serviceModel.price_type_id == pricingTypes.perPage) {
                    if (form.spacing_type == spacingTypes.double) {
                        // If spacing type is double
                        var base_price = parseFloat(
                            serviceModel.double_spacing_price
                        );
                    } else {
                        // If spacing type is single
                        var base_price = parseFloat(
                            serviceModel.single_spacing_price
                        );
                    }
                    var quantity = parseFloat(form.number_of_pages);
                }
                // Calculate Work Level Price
                var work_level_price = this.calculatePercentage(
                    base_price,
                    workLevelModel.percentage_to_add
                );
                // Calculate Urgency Price
                // var urgency_price = this.calculatePercentage(
                //     base_price,
                //     serviceModel.name === "Online Class"
                //         ? 0
                //         : urgencyModel.percentage_to_add
                // );
                var urgency_price = this.calculatePercentage(
                    base_price,
                    urgencyModel.percentage_to_add
                );
                // Calculate Guarantee Price
                var guarantee_price = this.calculatePercentage(
                    base_price,
                    guaranteeModel.percentage_to_add
                );

                // Calculate Unit Price
                var unit_price = Number(
                    parseFloat(
                        base_price +
                            work_level_price +
                            urgency_price +
                            guarantee_price
                    )
                ).toFixed(2);

                // Amount before including Additional Services
                var amount = (unit_price * quantity).toFixed(2);

                // Calculate Total Price of Additional Services
                let additional_services_cost = _.sumBy(
                    form.added_services,
                    function(row) {
                        return parseFloat(row.rate);
                    }
                );

                // Calculate Sub Total  Amount + Additional Services
                var sub_total = (
                    parseFloat(amount) + parseFloat(additional_services_cost)
                ).toFixed(2);

                // Total (work here if you need to add discount option)
                var total = sub_total;

                this.$set(
                    this.form,
                    "service_id",
                    subCategory ? subCategory.service_id : serviceModel.id
                );
                this.$set(this.form, "urgency_id", urgencyModel.id);
                this.$set(
                    this.form,
                    "urgency_percentage",
                    urgencyModel.percentage_to_add
                );
                this.$set(this.form, "dead_line", urgencyModel.date);

                this.$set(this.form, "work_level_id", workLevelModel.id);
                this.$set(
                    this.form,
                    "work_level_percentage",
                    workLevelModel.percentage_to_add
                );

                this.$set(this.form, "base_price", base_price);
                // unit price = base_price + work_level_price + urgency_price
                this.$set(this.form, "unit_price", unit_price);
                this.$set(this.form, "quantity", quantity);
                // amount = unit_price * quantity
                this.$set(this.form, "amount", amount);
                this.$set(this.form, "sub_total", sub_total);
                this.$set(this.form, "total", total);
                this.$set(this.form, "work_level_price", work_level_price);
                this.$set(this.form, "urgency_price", urgency_price);

                var $scope = this;

                Vue.nextTick(function() {
                    var records = Object.assign({}, $scope.form);
                    // Delete the following records before passing
                    delete records["number_of_words"];
                    delete records["number_of_pages"];
                    delete records["service_model"];
                    delete records["urgency_model"];
                    delete records["work_level_model"];
                    $scope.$emit("dataChanged", records);
                });

                let grandTotal = this.formatMoneyFromNumber(total);
                $scope.$emit("totalPrice", grandTotal);

                return grandTotal;
            }
        }
    },
    methods: {
        calculatePercentage(basePrice, percentageToAdd) {
            var number =
                (parseFloat(basePrice) * parseFloat(percentageToAdd)) / 100;
            return Number(parseFloat(number).toFixed(2));
        },
        isObjectEmpty(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        },
        formatMoneyFromNumber($amount) {
            return accounting.formatMoney($amount, currencyConfig.currency);
        }
    }
};
</script>
