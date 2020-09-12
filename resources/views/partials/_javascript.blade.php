<script src="{{ asset('js/app.js') }}"></script>
<script>
new Vue({
	el: '#categoryDropDown'
})
new Vue({
	el: '#successnotify'
})
new Vue({
	el: '#dangernotify',
})

new Vue({
	el: '#nightlight',
	data: {
		showModal: false
	}
})
new Vue({
	el: '#cookies',
	methods: {
		snackbar() {
			this.$buefy.snackbar.open({
				duration: 7000,
				message: '<form method="post" action="{{route('cookies.accepted')}}">{{ csrf_field() }}Използваме бисквитки! <a href="{{route('info.cookies')}}" class="has-text-info">Защо?</a> &nbsp;&nbsp;&nbsp;<button type="submit" class="button is-success is-small">ПРИЕМАМ</button></form>',
				type: 'is-danger',
				position: 'is-bottom',
				actionText: 'ЗАТВОРИ',
			})
		}
	}
})

jQuery(function(){
   jQuery('#cookies').click();
});

document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'complete') {
	  	setTimeout(function(){
        	document.getElementById('interactive');
        	document.getElementById('load').style.visibility="hidden";
		}, 300);
  }
}

</script>
