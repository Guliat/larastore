<div id="nightlight" v-cloak>
    <button class="button is-white has-text-dark is-medium" @click="showModal = true">
        <i class="fa fa-lightbulb-o fa-lg faa-tada animated"></i>
    </button>
    <div class="modal is-active" v-if="showModal">
    <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">ВНИМАНИЕ</p>
                <button class="delete" aria-label="close" @click="showModal = false"></button>
            </header>
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column is-one-fifth has-text-warning has-text-centered">
                        <i class="fa fa-lightbulb-o fa-4x"></i>
                    </div>
                    <div class="column">
                        Молим обърнете внимание дали функцията <b>"по-топъл цвят на дисплея"</b> ви е активирана, защото това може в голяма степен да промени реалния цвят на продуктите.
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <form method="post" action="{{route('nightlight')}}">
                    {{ csrf_field() }}
                    <button type="submit" class="button is-success">ОК</button>
                </form>
                <a class="button is-light" @click="showModal = false">ЗАТВОРИ</a>
            </footer>
        </div>
    </div>
</div>
