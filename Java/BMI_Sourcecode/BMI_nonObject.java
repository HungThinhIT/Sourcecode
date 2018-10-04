package bmi_calculation;

import java.util.Scanner;

/*
 * Author: Nguyen Hung Thinh
 */

public class BMI_nonObject {
	private static double height = 0.0;
	private static double weight = 0.0;
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Input();
		System.out.println(getResult());
	}

	public static void Input() {
		Scanner keyb = new Scanner(System.in);
		System.out.print("Nhap vao chieu cao cua ban (cm): ");
		height = Double.parseDouble(keyb.nextLine());
		System.out.print("\nNhap vao can nang cua ban (kg): ");
		weight = Double.parseDouble(keyb.nextLine());
	}
	
	public static double CalculationBMI() {
		double result = weight *10000 / Math.pow(height, 2);
		return result;
	}
	
	public static String getResult() {
		System.out.println("Chi so BMI cua ban la :" + CalculationBMI() + "\n");
		if( CalculationBMI() < 0 )
			return " Chi so BMI khong hop le";
		else if(CalculationBMI() >= 0 && CalculationBMI() < 18.5) 
			return "==> Gay";
		else if( CalculationBMI() >= 18.5 && CalculationBMI() <= 24.9) 
			return "==> Binh Thuong"; 
		else if( CalculationBMI() >= 25.0 && CalculationBMI() <= 29.9) 
			return "==> Hoi Beo";
		else if( CalculationBMI() >= 30.0 && CalculationBMI() <= 34.9) 
			return "==> Beo phi cap do";
		else if( CalculationBMI() >= 35.0 && CalculationBMI() <= 39.9) 
			return "==> Beo phi cap do 2"; 
		else if ( CalculationBMI() >= 40.0)
			return "==> Beo phi cap do 3";
		else
			return "==> Chi so BMI khong hop le";
	}
}
