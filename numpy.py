import numpy as np

print("=== Creating Arrays ===")
# 1D array
A = np.array([1, 2, 3, 4, 5])
print("1D array:", A)

# 2D array
B = np.array([[1, 2, 3], [4, 5, 6]])
print("2D array:\n", B)

# Array of zeros
arrayOfZeros = np.zeros((3, 4))
print("Zeros array:\n", arrayOfZeros)

# Array of ones
arrayOfOnes = np.ones((2, 5))
print("Ones array:\n", arrayOfOnes)

# Range array
rangearray = np.arange(0, 10, 2)
print("Range array:", rangearray)

# Evenly spaced numbers
linespacearray = np.linspace(0, 1, 5)
print("Linspace array:", linespacearray)

print("\n=== 2. Array Operations ===")
arr1 = np.array([10, 20, 30])
arr2 = np.array([1, 2, 3])
print("Array 1:", arr1)
print("Array 2:", arr2)
print("Addition:", arr1 + arr2)
print("Subtraction:", arr1 - arr2)
print("Multiplication:", arr1 * arr2)
print("Division:", arr1 / arr2)
print("Square root of a:", np.sqrt(arr1))
print("Mean of a:", np.mean(arr1))

print("\n=== Reshaping and Indexing ===")
a = np.arange(12)  # 0 to 11
print("Original array:", a)
reshaped_arr = a.reshape(4,3)  # reshape to 3x4
print("Reshaped array:\n", reshaped_arr)
print("Element at row 1, col 2:", reshaped_arr[2,1])
print("First row:", reshaped_arr[0, :])
print("First column:", reshaped_arr[:, 0])

print("\n=== Matrix Multiplication ===")
A = np.array([[5, 6], [1, 2]])
B = np.array([[3, 4], [9, 6]])
print("Matrix A:\n", A)
print("Matrix B:\n", B)
C = np.dot(A, B)
print("A x B =\n", C)