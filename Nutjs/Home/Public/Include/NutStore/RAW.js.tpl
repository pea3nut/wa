<script type="text/javascript">
    window.RAW={};
    RAW.D={
        "works.inf.id" :"{$_data.works.inf.id}",
    };
    RAW.U={
        "NutStore/read/self"            :"{:U('NutStore/read/'.$_data['works']['inf']['id'])}/",
        "Behavior/upload/works_banner"  :"{:U('Behavior/upload/works_banner')}",
        "Behavior/upload/works_section" :"{:U('Behavior/upload/works_section')}",
        "Behavior/delete/works_banner"  :"{:U('Behavior/delete/works_banner')}",
        "Behavior/delete/works_section" :"{:U('Behavior/delete/works_section')}",
        "Service/ns_edit_section"       :"{:U('Service/ns_edit_section')}",
        "Service/ns_create_section"     :"{:U('Service/ns_create_section')}",
        "Service/ns_create_works_log"   :"{:U('Service/ns_create_works_log')}",
        "Service/ns_delete_works"       :"{:U('Service/ns_delete_works')}",
        "Service/ns_delete_section"     :"{:U('Service/ns_delete_section')}",
        "Service/ns_delete_works_log"   :"{:U('Service/ns_delete_works_log')}",
    };
</script>