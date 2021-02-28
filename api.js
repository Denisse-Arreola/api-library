class Api{
    constructor(){
        this.url= ''
        this.category = 'all'
        this.numItems = '10'
        
    }

    setCategory = category => this.category = category
    setNumItems = numItems => this.numItems = numItems

    searchBooks(word){

        console.log(this.url+'keyword='+word+'&category='+this.category+'&num_items='+this.numItems)

        fetch(this.url+'keyword='+word+'&category='+this.category+'&num_items='+this.numItems)
    }

    getbook(id){

        console.log(this.url+'id='+id)

    }

    fetch(this.url,
        {
            keyword : word,
            category : this.category,
            numItems : this.numItems}

        })

}

obj = new Api()

obj.setCategory('Matematicas')
obj.setNumItems('15')

obj.getbook('35325')

