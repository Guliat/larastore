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
<script>
  new Vue({
    el: '#toasts',
    methods: {
      updated() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fa fa-check"></i> Обновено!',
          position: 'is-top',
          type: 'is-success'
        })
      },
      added() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fa fa-check"></i> Added!',
          position: 'is-top',
          type: 'is-info'
        })
      },
      deleted() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fa fa-check"></i> Deleted!',
          position: 'is-top',
          type: 'is-danger'
        })
      },
      undeleted() {
        this.$buefy.toast.open({
          duration: 1000,
          message: '<i class="fa fa-check"></i> Undeleted!',
          position: 'is-top',
          type: 'is-warning'
        })
      }
    }
  })
  </script>
  <?php
    if(Session::has('updated')) { 
      echo '<script> document.getElementById("updated_toast").click(); </script>';
    }
    if(Session::has('added')) { 
      echo '<script> document.getElementById("added_toast").click(); </script>';
    }
    if(Session::has('deleted')) { 
      echo '<script> document.getElementById("deleted_toast").click(); </script>';
    }
    if(Session::has('undeleted')) { 
      echo '<script> document.getElementById("undeleted_toast").click(); </script>';
    }
  ?>