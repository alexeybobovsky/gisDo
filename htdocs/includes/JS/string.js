/*работа со строками*/
function trim_spaces(from_where) {
    
    // Store the string in a temporary variable    
    var temp_string = this

    // If no argument, then trim from both sides
    if (arguments.length == 0) {
        from_where = "BOTH"
    }
    
    // Trim spaces from the left
    if (from_where.toUpperCase() == "LEFT" || from_where == "BOTH") {
        while (temp_string.left(1) == " ") {
            temp_string = temp_string.substring(1)
        }
    }
    
    // Trim spaces from the right
    if (from_where.toUpperCase() == "RIGHT" || from_where == "BOTH") {
        while (temp_string.right(1) == " ") {
            temp_string = temp_string.substring(0, temp_string.length - 2)
        }
    }
    return temp_string   

}

function extract_left(total_chars) {
    return this.substring(0, total_chars)
}

function extract_right(total_chars) {
    return this.substring(this.length - total_chars)
}

String.prototype.right = extract_right
String.prototype.left = extract_left
String.prototype.trim = trim_spaces
