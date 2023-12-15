<template>
    <div class="section">
        <div class="container">
            <div class="row">
                <h3> Chat history</h3>
                <hr>
                <table id="mytable" class="row table table-responsive table-striped table-hover w-100" >
                    <thead>
                    <th>Name</th>
                    <th>Agent Name</th>
                    <th>Time</th>
                    <th>Message</th>
                    </thead>
                    <tbody id="mytable_body" >
                        <tr v-for="item in list" :key="item">
                            <td>#{{ item.visitor_id }}</td>
                            <td>{{ item.agent_name }}</td>
                            <td>{{ item.updated_at }}</td>
                            <td>Hi there looking for custom boxes.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>


import axios from 'axios'
export default {
    name: 'HISTORY',
    data(){
      return {
        list:[]
      }
    },
    async mounted() {
      let history = await axios.get('http://127.0.0.1:8000/api/live-visitor')
      console.warn('Chat History :',history.data.data);
      this.list = history.data.data

    }

}

</script>
<style scoped>
.section{
    padding: 10px 20px;
}
#mytable {
    height: 602px;
}
</style>
