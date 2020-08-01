<template>
  <div>
      <h1>Comments</h1>
      <table>
          <tr>
              <th>Comment</th>
              <th>Initials</th>
          </tr>
          <tr v-for="(comment, idx) in comments" v-bind:key='idx'>
              <td>{{comment.comment}}</td>
              <td>{{comment.initials}}</td>
          </tr>
          </table>
  </div>
</template>

<script>

export default {
  data () {
    return {
        comments:[],
    }
  },
  methods: {
      fetchComments() {
          fetch('api/comments')
          .then(res=>res.json())
          .then(res=>{
              this.comments = res
              console.log(res);
          });
      }
  },
  created() {
      this.fetchComments();
  },
}
</script>

<style lang="scss" scoped>
    h1 {color:red;}
</style>