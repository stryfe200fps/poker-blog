<template>
    <div class="table-responsive">
        <table class="c-table table">
            <slot name="table-head"></slot>
            <slot name="table-body"></slot>
        </table>
    </div>
</template>

<style>
.table-responsive {
    border: unset;
}

.table {
    margin-bottom: unset;
}

.c-table {
    width: 100%;
}

.c-table tr {
    background-color: #fbfbfb;
    border: 1px solid #95a5a662;
}

.c-table tr th {
    padding: 10px 5px;
}

.c-table tr td {
    padding: 10px 5px;
}

.c-table tr td img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.c-table tr {
    font-family: "Lato", sans-serif;
    font-size: 14px;
}

.c-table tr th {
    text-transform: capitalize;
}

@media (min-width: 768px) {
    .c-table tr th,
    .c-table tr td {
        padding: 10px 20px;
    }
}
</style>
