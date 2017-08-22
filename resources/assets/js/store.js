import Vuex from "vuex";
import Vue from "vue";


Vue.use(Vuex)


export const store = new Vuex.Store({

        state:{
            nots:[],
            posts:[],
            auth_user:{},
            my_posts:[]
                
        },
        getters:{
            all_nots(state){
                return state.nots;
            },
            all_nots_count(state){
               return state.nots.length;
                    
            },
            all_posts(state){
                return state.posts;
            },
                my_posts(state){
                        return state.my_posts;
                }
        },
        mutations:{
            add_not(state,not){
                state.nots.push(not);
            },
            add_post(state,post){
                state.posts.push(post);
            },
            auth_user_data(state,auth){
                    state.auth_user = auth;
            },
            update_like(state,payload){
                var post = state.posts.find((post)=>{
                    return post.id === payload.post_id
                })
                post.likes.push(payload.like);
            },
            delete_like(state,payload){
                var post = state.posts.find((post)=>{
                    return post.id === payload.post_id
                })
                var like = post.likes.find((like)=>{
                    return like.id = payload.like_id
                })
                var index = post.likes.indexOf(like);
                post.likes.splice(index,1);
            },
                add_comment(state,payload){
                   var post =  state.posts.find((resp)=>{
                        return resp.id === payload.post_id
                    })
                    post.comments.push(payload.comment);
                },
                add_my_posts(state,posts){
                    state.my_posts.push(posts)
                }
        }

});