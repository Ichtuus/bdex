<template>
    <section class="padding-top-35 no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <div class="statistic-block block">
                        <slot name="title"></slot>
                    </div>
                </div>
                <div class="col-md-12 col-sm-6">
                    <div class="statistic-block block">
                        <slot name="body"></slot>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
    .padding-top-35 {
        padding-top: 35px;
    }
</style>
