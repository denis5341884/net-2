<table border="1" style="width: 80%;">
    <thead>
        <tr>
            <td><b>Product</b></td>
            <td><b>Description</b></td>
            <td><b>Value</b></td>
            <td><b>Date</b></td>
        </tr>
    </thead>
    <tbody>
        {% for product in products %}
            <tr>
                <td>{{ product.name|escape }}</td>
                <td>{{ product.description|escape }}</td>
                <td>{{ product.value|escape }}</td>
                <td>{{ product.date_register|date("m/d/Y")|escape }}</td>
            </tr>
        {% endfor %}
    </tbody>
</table>