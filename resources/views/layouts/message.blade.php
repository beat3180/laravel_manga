<!-- フラッシュメッセージ -->
<script type="text/javascript">
    // {{--成功時--}}
    @if (session('msg_success'))
        $(function () {
            toastr.success('{{ session('msg_success') }}');
        });
    @endif

    // {{--失敗時--}}
    @if (session('msg_danger'))
        $(function () {
            toastr.danger('{{ session('msg_danger') }}');
        });
    @endif
</script>
