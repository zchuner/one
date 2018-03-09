window.onload = function () {
    $.get( url + '/admin/category?all=1', '', function (res) {
        var config = {
            className: "tablelist",
            id: "categoryTable",
            width: "100%",
            renderTo: "category",
            headerAlign: "left",
            headerHeight: "30",
            dataAlign: "left",
            indentation: "30",
            folderOpenIcon: url + "/assets/admin/images/folderOpen.png",
            folderCloseIcon: url + "/assets/admin/images/folderClose.png",
            defaultLeafIcon: url + "/assets/admin/images/defaultLeaf.gif",
            hoverRowBackground: "false",
            folderColumnIndex: "1",
            itemClick: "",
            columns: [
                {
                    headerText: "选择",
                    dataField: "cat_id",
                    handler: "customCheckBox",
                    width: "5%"
                },
                {
                    headerText: "名称",
                    dataField: "cat_name",
                    handler: "customOrgName",
                    width: "35%"
                },
                {
                    headerText: "数据量",
                    dataField: "items",
                    width: "5%"
                },
                {
                    headerText: "静态",
                    dataField: "is_html",
                    width: "5%",
                    handler: "isHtml"
                },
                {
                    headerText: "模型",
                    dataField: "model",
                    handler: "modelName",
                    width: "5%"
                },
                {
                    headerText: "操作",
                    width: "10%",
                    handler: "customLook"
                }
            ],
            data: res
        };
        var treeGrid = new TreeGrid(config);
        treeGrid.show()
    }, 'json');
};