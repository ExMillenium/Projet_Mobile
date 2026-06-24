import React from 'react'

const Search = ({searchTerm, setSearchTerm}) => {
    return(
        <div className = "search.svg" alt= "search">
            <input
                type = "text"
                placeholder = "Search Through thousands of movies"
                value = {searchTerm}
                onChange = {(event) => setSearchTerm(event.target.value)}
            />
        </div>
    )
}

export default Search