@section('libraries')
	<link href="{{ asset('/css/summernote-bs4.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/summernote-bs4.js') }}"></script>
	{{-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">   --}}
	<style type="text/css">
		.note-group-select-from-files {
		  display: none;
		}
	</style>
@endsection

@section('scripts')
	<script>
		$.ajax({
		  url: 'https://api.github.com/emojis',
		  async: false
		}).then(function(data) {
		  window.emojis = Object.keys(data);
		  window.emojiUrls = data;
		});;

		$('#summernote').summernote({
		  height: 300,
		  placeholder: 'Write something beautiful!',

		  toolbar: [
		    ['style', ['style']],
		    ['font', ['bold', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
		    ['fontname', ['fontname', 'fontsize', 'forecolor', 'backcolor']],
		    ['para', ['ul', 'ol', 'paragraph', 'height']],
		    ['hr', ['hr']],
		    ['table', ['table']],
		    ['insert', ['link', 'picture', 'video']],
		    ['view', ['fullscreen', 'codeview', 'help']],
		  ],

		  hint: {
		    match: /:([\-+\w]+)$/,
		    search: function (keyword, callback) {
		      callback($.grep(emojis, function (item) {
		        return item.indexOf(keyword)  === 0;
		      }));
		    },
		    template: function (item) {
		      var content = emojiUrls[item];
		      return '<img src="' + content + '" width="20" /> :' + item + ':';
		    },
		    content: function (item) {
		      var url = emojiUrls[item];
		      if (url) {
		        return $('<img />').attr('src', url).css('width', 20)[0];
		      }
		      return '';
		    }
		  }
		});

		$(document).ready(function() {
		    $('#summernote').summernote();
		});
	</script>
@endsection
