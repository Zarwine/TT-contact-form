class Dashboard 
{
    constructor(comment){
        this.initDashboard(document.querySelectorAll(comment))
    }

    initDashboard(comments) {
        //console.log(comments)
        for(let i=0; i<comments.length; i++) {
            comments[i].style.height = "2em"
            let clickZone = comments[i].querySelector(".container")
            clickZone.addEventListener('click', () => {
               
                if(comments[i].style.height === "2em"){
                    comments[i].style.height = "auto"
                } else {
                    comments[i].style.height = "2em"
                }
            })
        }

    }
}

let dashBoardManager = new Dashboard(".comment")
