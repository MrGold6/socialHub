<script>
    $('body').delegate('#like', 'click', function (event) {
        let postId = $(this).attr('postId')

        const target = event.currentTarget;
        $.ajax({
            url: '{{ route('likePost') }}',
            method: 'post',
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'),
                idPost: postId
            },
            success: function (data) {
                if(data[0]) {
                    target.classList.remove('far');
                    target.classList.add('fas', 'pulse');
                } else {
                    target.classList.remove('fas');
                    target.classList.add('far');
                }
                $('label[postId=' + postId + ']').text(data[1])
            }
        })
    })
</script>
