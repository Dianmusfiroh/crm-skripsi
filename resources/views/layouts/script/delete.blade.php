<script>
    var url = '';
    const deleteData = (id) =>{
        url = '{{route("${modul}.destroy",":id")}}';

        url = url.replace(':id',id);
    console.log(url);

        $("#deleteForm").attr('action',url);
    }

    const formSubmit = () => {
        $("#deleteForm").submit();
    }
</script>
