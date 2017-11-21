import '../../common.js'
import MyVuetable from '../../../../components/MyVuetable.vue'
import MyToastr from '../../../../components/MyToastr.vue'
import TableActions from './components/TableActions.vue'

Vue.component('table-actions', TableActions)

new Vue({
  el: '#app',
  components: {
    MyVuetable,
    MyToastr,
  },
  data: {
    eventHub: new Vue(),
    activatedRow: {},

    serverListApi: '/admin/api/platform/server/list',
    tableFields: [
      {
        name: 'id',
        title: '游戏服ID',
      },
      {
        name: 'area',
        title: '地区',
      },
      {
        name: 'server_name',
        title: '名称',
      },
      {
        name: 'server_status',
        title: '状态',
      },
      {
        name: 'rate',
        title: '导量权重',
      },
      {
        name: 'is_update',
        title: '正在更新',
        callback: 'transValue',
      },
      {
        name: 'open_time',
        title: '开服时间',
      },
      {
        name: 'server_address',
        title: '场景服地址',
      },
      {
        name: 'server_type',
        title: '服务器类型',
      },
      {
        name: 'can_see',
        title: '是否展示',
        callback: 'transValue',
      },
      {
        name: 'is_cron',
        title: '是否执行统计脚本',
        callback: 'transValue',
      },
      {
        name: '__component:table-actions',
        title: '操作',
        titleClass: 'text-center',
        dataClass: 'text-center',
      },
    ],
    tableCallbacks: {
      transValue (value) {
        if (value === 1) {
          return '是'
        }
        return '否'
      },
    },
  },

  methods: {

  },

  mounted: function () {
    this.$root.eventHub.$on('editServerEvent', (data) => this.activatedRow = data)
  },
})